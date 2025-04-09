<template>
  <q-page padding>
    <!-- content -->
    <h4>EditPost Page</h4>

    <div class="q-ma-lg">
      <q-input v-model="post.name" type="text" label="name" outlined rounded />
      <q-input v-model="post.category" type="number" label="category" outlined rounded />
      <q-input v-model="post.body" type="textarea" label="body" outlined rounded />
      <q-btn color="green-9" class="q-ma-md" @click="create"> create </q-btn>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { usePostData } from 'src/stores/PostData'
import { onMounted, reactive } from 'vue'
import { useRoute } from 'vue-router'

const post = reactive({
  name: null,
  category: null,
  body: null,
})
const route = useRoute()
const PostData = usePostData()
onMounted(() => {
  if (PostData.post.length > 0) {
    (post.name = PostData.post[PostData.currentPostIndex].name),
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
</script>
