<template>
  <q-page padding>
    <!-- content -->
    <h3>Edit Category Page</h3>

    <q-input v-model="category.name" type="text" label="name" outlined rounded />
    <q-input v-model="category.body" type="textarea" label="body" outlined rounded />
  </q-page>
</template>

<script setup>
import { usecategoryData } from 'src/stores/categoryData'
import { onMounted, reactive } from 'vue'

const categoryData = usecategoryData()
const category = reactive({
  name: null,
  body: null,
})

onMounted(() => {
  if (categoryData.category.length > 0) {
    category.body = categoryData.category[categoryData.currentCategoryIndex].body
    category.name = categoryData.category[categoryData.currentCategoryIndex].name
  }
})
</script>
