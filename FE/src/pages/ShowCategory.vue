<template>
  <q-page padding>
    <!-- content -->
    <h4>ShowCategoryPage</h4>

    <div class="row">
      <div class="col">{{ category?.name || 'بدون نام' }}</div>
      <div class="col">{{ category?.body || 'بدون بادی' }}</div>
      <!-- <div class="col">{{ category?.user.name || 'بدون یوزر' }}</div> -->
      <div class="col">
        <q-btn color="yellow-9"> edit </q-btn>
      </div>
      <div class="col">
        <q-btn color="red-8"> delete </q-btn>
      </div>
      <div class="col"><q-btn color="green-9"> show </q-btn></div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
// import { usecategoryData } from 'src/stores/categoryData'
import { onMounted, reactive } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
// const categoryData = usecategoryData()
const category = reactive({
  name: null,
  body: null,
})

onMounted(() => {
  // if (categoryData.currentCategoryIndex.length > 0) {
  //   ;(category.name = categoryData.currentCategoryIndex.name),
  //     (category.body = categoryData.currentCategoryIndex.body)
  // } else {
    api
      .get('api/category/' + route.params.id)
      .then((r) => {
        category.name = r.data.name
        category.body = r.data.body
      })
      .catch((e) => {
        console.log('error', e)
      })
  // }
})
</script>
