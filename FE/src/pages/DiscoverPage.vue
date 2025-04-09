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
            <p>{{ post?.body || 'بدون بادی' }}</p>
          </q-card-section>
          <q-card-action>
            <q-btn color="amber-9"
              @click="
                postdata.currentPostIndex = index;
                $router.push('edit-post/' + post.id)
              "
            >
              Edit
            </q-btn>
            <q-btn>Delete</q-btn>
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

const posts = ref([])
const loading = ref(false)
const postdata = usePostData()

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
</script>
