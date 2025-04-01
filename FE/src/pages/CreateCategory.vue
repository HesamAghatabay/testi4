<template>
  <q-page padding>
    <!-- content -->
    <h4>Create Category Page</h4>

    <q-input v-model="category.name" type="text" label="name" outlined rounded />
    <q-input v-model="category.body" type="textarea" label="body" outlined rounded />
    <q-btn color="blue-9" class="q-ma-sm" @click="create"> Create </q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { reactive } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const category = reactive({
  name: null,
  body: null,
})

function create() {
  api
    .post('api/category', category)
    .then((r) => {
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'create category successful ' + r.data.message,
      })
      router.push('category')
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'create category in cach ' + e,
      })
    })
}
</script>
