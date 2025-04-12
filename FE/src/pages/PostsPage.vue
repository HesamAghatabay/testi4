<template>
  <q-page padding>
    <!-- content -->
    <h4>PostsPage</h4>
    <div class="col-3 q-gutter-lg">
      <q-card>
        <q-card-section>
          <h4>{{ post?.name || 'بدون نام' }}</h4>
        </q-card-section>
        <q-card-section>
          <p>{{ post?.body || 'بدون بادی' }}</p>
        </q-card-section>
        <q-card-action>
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
        </q-card-action>
      </q-card>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { onMounted, reactive } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const post = reactive({
  name: null,
  category: null,
  body: null,
})

onMounted(() => {
  api
    .get('api/post/' + route.params.id)
    .then((r) => {
      post.name = r.data.name
      post.category = r.data.category
      post.body = r.data.body
    })
    .catch((e) => {
      console.log(e)
    })
})
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
</script>
