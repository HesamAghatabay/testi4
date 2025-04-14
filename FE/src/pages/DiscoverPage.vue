<template>
  <q-page padding>
    <!-- content -->
    <h4>DiscoverPage</h4>
    <q-btn to="create-post" color="green-9"> Create Post </q-btn>

    <q-inner-loading :showing="loading" color="red-8" size="65px" />

    <div class="row">
      <div class="col-3 q-gutter-lg" v-for="(post, index) in posts" :key="'post' + index">
        <q-card>
          <q-card-section>
            <h4>{{ post?.name || 'بدون نام' }}</h4>
          </q-card-section>

          <q-card-section>
            <h6>{{ post?.auther.full_name || 'بدون نام' }}</h6>
          </q-card-section>

          <q-card-section>
            <p>{{ post?.body || 'بدون بادی' }}</p>
          </q-card-section>

          <q-card-caption>
            <q-btn v-if="post.Likes.length > 0" @click="unLike(index)"> unLike </q-btn>
            <q-btn v-else @click="Like(index)"> Like </q-btn>
          </q-card-caption>

          <br />
          <q-card-action align="around">
            <q-btn
              color="amber-9"
              @click="
                postdata.currentPostIndex = index;
                $router.push('edit-post/' + post.id)
              "
            >
              Edit
            </q-btn>
            <q-btn color="red-9" @click="deletepost(post.id)">Delete</q-btn>
            <q-btn color="info" @click="$router.push('show-post/' + post.id)">Show</q-btn>
          </q-card-action>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { usePostData } from 'src/stores/PostData'
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'

const posts = ref([])
const loading = ref(false)
const postdata = usePostData()
const router = useRouter()
onMounted(() => {
  fetchPosts()
})
function fetchPosts() {
  loading.value = true
  api
    .get('api/post')
    .then((r) => {
      posts.value = r.data
      postdata.post = r.data
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'geting posts in cach ' + e,
      })
    })
    .finally(() => {
      loading.value = false
    })
}
function deletepost(id) {
  api
    .delete(`api/post/${id}`)
    .then((r) => {
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'delete post successful ' + r.data.message,
      })
      router.push('discover-post')
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'delete post in cach ' + e,
      })
    })
}
function Like(index) {
  api
    .post('api/post/' + posts.value[index].id + '/Like', {
      Liked: true,
    })
    .then(() => {
      posts.value[index].Like = true
    })
}
function unLike(index) {
  api
    .post('api/post/' + posts.value[index].id + '/unLike', {
      Liked: true,
    })
    .then(() => {
      posts.value[index].Like = false
    })
}
</script>
