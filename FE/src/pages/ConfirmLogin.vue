<template>
  <q-page padding>
    <!-- content -->
    <h3>Confirm Login Page</h3>
    <q-input class="q-mx-lg" v-model="password" label="password" outlined rounded />
    <q-btn @click="confirmlogin" class="q-ma-md" color="blue-8">Confirm Login</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const password = ref('')
const route = useRoute()
const router = useRouter()
const mobile = route.params.number

function confirmlogin() {
  api
    .post('oauth/token', {
      username: mobile,
      password: password.value,
      grant_type: 'password',
      client_id: 2,
      client_secret: 'EzB4uJuRnPClYPOt3GS82YntZyYw4QjwVHTdQAtk',
      scope: '*',
    })
    .then((r) => {
      console.log(r.date)
      if (r.data.access_token) {
        localStorage.setItem('access_token', r.data.access_token)
        api.defaults.headers = {
          Authorization: 'Bearer ' + localStorage.getItem('access_token'),
          'Content-Type': 'application/json',
          Accept: 'application/json;charset=UTF-8',
        }
      }
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'confirm login is successfull ' + r.data.message,
      })
      router.push('/')
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'Login error ' + e,
      })
    })
}
</script>
