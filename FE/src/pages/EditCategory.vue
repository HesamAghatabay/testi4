<template>
  <q-page padding>
    <!-- content -->
    <h3>Edit Category Page</h3>

    <q-input v-model="category.name" type="text" label="name" outlined rounded />
    <q-input v-model="category.body" type="textarea" label="body" outlined rounded />
    <q-btn color="yellow-9" class="q-ma-sm" @click="edit"> Edit </q-btn>

  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { usecategoryData } from 'src/stores/categoryData'
import { onMounted, reactive } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const categoryData = usecategoryData()
const route = useRoute()
const router =useRouter()
const category = reactive({
  name: null,
  body: null,
})

onMounted(() => {
  if (categoryData.category.length > 0) {
    category.body = categoryData.category[categoryData.currentCategoryIndex].body
    category.name = categoryData.category[categoryData.currentCategoryIndex].name
  } else {
    fetchCategory()
  }
})
function fetchCategory() {
  api
    .get('api/category' + route.params.id)
    .then((r) => {
      category.name = r.data.name
      category.body = r.data.body
    })
    .catch((e) => {
      console.log(e)
      if (e.status === 401) {
        localStorage.removeItem('access_token')
        window.location.href = '/'
      }
      if (e.status === 500) {
        Notify.create({
          type: 'negative',
          message: 'Server error',
          icon: 'error',
        })
      }
    })
}
function edit(){
  api
    .put('api/category/' + route.params.id, category)
    .then((r) => {
      if (r.data.status) {
        Notify.create({
          type: 'positive',
          message: 'category updated successfully',
        })
        router.push('/category')
      } else {
        Notify.create({ type: 'negative', message: 'Post creation failed' })
      }
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        message: 'Post creation failed',
      })
    })
}
</script>
