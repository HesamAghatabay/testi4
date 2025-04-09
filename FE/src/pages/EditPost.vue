<template>
  <q-page padding>
    <!-- content -->
    <h4>EditPost Page</h4>

    <div class="q-ma-lg">
      <q-input v-model="post.name" type="text" label="name" outlined rounded />
      <q-input v-model="post.category" type="number" label="category" outlined rounded />
      <q-input v-model="post.body" type="textarea" label="body" outlined rounded />
      <q-btn color="amber-9" class="q-ma-md" @click="edit"> Edit </q-btn>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { usePostData } from 'src/stores/PostData'
import { onMounted, reactive } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const post = reactive({
  name: null,
  category: null,
  body: null,
})
const route = useRoute()
const PostData = usePostData()
onMounted(() => {
  if (PostData.post.length > 0) {
    ;(post.name = PostData.post[PostData.currentPostIndex].name),
      (post.category = PostData.post[PostData.currentPostIndex].category),
      (post.body = PostData.post[PostData.currentPostIndex].body)
  } else {
    fetchPost()
  }
})
function fetchPost() {
  api
    .get('api/post/' + route.params.id)
    .then((r) => {
      ;(post.name = r.data.name), (post.category = r.data.category), (post.body = r.data.body)
    })
    .catch((e) => {
      console.log(e)
    })
}
function edit() {
  api
    .put('api/post/' + route.params.id, post)
    .then((r) => {
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'update post successful ' + r.data.message,
      })
      router.push('discover-post')
    })
    .catch((e) => {
      Notify.create({ type: 'negative', position: 'top', message: 'update post in cach ' + e })
    })
}
</script>
