<template>
  <q-page padding>
    <!-- content -->
    <h4>CreatePost Page</h4>
    <div class="q-ma-lg">
      <q-input v-model="post.name" type="text" label="name" outlined rounded />
      <q-input v-model="post.category" type="number" label="category" outlined rounded />
      <q-input v-model="post.body" type="textarea" label="body" outlined rounded />
      <q-btn color="green-9" class="q-ma-md" @click="create"> create </q-btn>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { reactive } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const post = reactive({
  name: null,
  category: null,
  body: null,
})

function create() {
  api
    .post('api/post', post)
    .then((r) => {
      console.log(r.data)
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'create post successful ' + r.data.message,
      })
      router.push('discover-post')
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'create post in cach ' + e,
      })
    })
}
</script>
