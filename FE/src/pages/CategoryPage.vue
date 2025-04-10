<template>
  <q-page padding>
    <!-- content -->
    <q-inner-loading :showing="loading" color="red-8" size="65px" />

    <q-btn to="create-category" class="q-my-md" color="green-9">Create New Category</q-btn>

    <div class="row" v-for="(category, index) in categories" :key="'category' + index">
      <div class="col">{{ category?.name || 'بدون نام' }}</div>
      <div class="col">{{ category?.body || 'بدون بادی' }}</div>
      <div class="col">{{ category?.user.name || 'بدون یوزر' }}</div>
      <div class="col">
        <q-btn
          @click="
            categoryData.currentCategoryIndex = index;
            $router.push('edit-category/' + category.id)
          "
          color="yellow-9"
        >
          edit
        </q-btn>
      </div>
      <div class="col">
        <q-btn color="red-8" @click="deletecategory(category.id)"> delete </q-btn>
      </div>
      <div class="col">
        <q-btn
          color="green-9"
          @click="
            categoryData.currentCategoryIndex = index;
            $router.push('show-category/' + category.id)
          "
        >
          show
        </q-btn>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { usecategoryData } from 'src/stores/categoryData'
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'

const categories = ref([])
const loading = ref(false)
const categoryData = usecategoryData()
const router = useRouter()

onMounted(() => {
  loading.value = true
  api
    .get('api/category')
    .then((r) => {
      console.log('category', r.data)
      categories.value = r.data
      categoryData.category = r.data
    })
    .catch((e) => {
      console.log(e)
    })
    .finally(() => {
      loading.value = false
    })
})
function deletecategory(id) {
  api
    .delete(`api/category/${id}`)
    .then((r) => {
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'delete category successful ' + r.data.message,
      })
      router.push('/')
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'delete post in cach ' + e,
      })
    })
}
</script>
