<template>
  <q-page padding>
    <!-- content -->
    <h4>CreatePost Page</h4>
    <div class="q-ma-lg">
      <q-input v-model="post.name" type="text" label="name" outlined rounded />
      <q-input v-model="post.body" type="textarea" label="body" outlined rounded />
      <q-btn color="green-9" class="q-ma-md" @click="create"> create </q-btn>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { reactive } from 'vue'

const post = reactive({
  name: null,
  body: null,
})

function create() {
  api
    .post('api/post', post)
    .then((r) => {
      console.log(r.data)
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
