<template>
  <q-page padding>
    <!-- content -->
    <q-inner-loading :showing="loading" color="red-8" size="65px" />

    <q-btn to="create-category" class="q-my-md" color="green-9">Create New Category</q-btn>

    <div class="row" v-for="(category, index) in categories" :key="'category' + index">
      <div class="col">{{ category?.name || 'بدون نام' }}</div>
      <div class="col">{{ category?.body || 'بدون بادی' }}</div>
      <div class="col">{{ category?.user.name || 'بدون یوزر' }}</div>
      <div class="col">edit</div>
      <div class="col">delete</div>
      <div class="col">show</div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'

const categories = ref(null)

const loading = ref(false)
onMounted(() => {
  loading.value = true
  api
    .get('api/category')
    .then((r) => {
      console.log('category', r.data)
      categories.value = r.data
    })
    .catch((e) => {
      console.log(e)
    })
    .finally(() => {
      loading.value = false
    })
})
</script>
