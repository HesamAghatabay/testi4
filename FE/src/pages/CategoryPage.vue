<template>
  <q-page padding>
    <!-- content -->
    <q-btn to="create-category" class="q-my-md" color="green-9">Create New Category</q-btn>

    <div class="row">
      <div class="col">{{ name }}</div>
      <div class="col">{{ body }}</div>
      <div class="col">{{ user }}</div>
      <div class="col">edit</div>
      <div class="col">delete</div>
      <div class="col">show</div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'

const name = ref('')
const body = ref('')
const user = ref('')

onMounted(() => [
  api
    .get('category')
    .then((r) => {
      name.value = r.data.name
      body.value = r.data.body
      user.value = r.data.name
    })
    .catch((e) => {
      console.log(e)
    }),
])
</script>
