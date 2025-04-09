<template>
  <q-page padding>
    <!-- content -->
    <h3>Login Page</h3>
    <q-input class="q-mx-lg" v-model="mobile" label="Mobile" outlined rounded />
    <q-input
      class="q-mx-lg"
      v-model="password"
      label="Password"
      outlined
      rounded
      :type="isPwd ? 'password' : 'text'"
    >
      <template v-slot:append>
        <q-icon
          :name="isPwd ? 'visibility_off' : 'visibility'"
          class="cursor-pointer"
          @click="isPwd = !isPwd"
        />
      </template>
    </q-input>

    <q-btn @click="login" class="q-ma-md" color="blue-8">Login</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const mobile = ref('')
const password = ref('')
const isPwd = ref(true)
const router = useRouter()

function login() {
  api
    .post('oauth/token', {
      username: mobile.value,
      password: password.value,
      grant_type: 'password',
      client_id: 2,
      client_secret: 'EzB4uJuRnPClYPOt3GS82YntZyYw4QjwVHTdQAtk',
      scope: '*',
    })
    .then((r) => {
      console.log('status', r.data)
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
        message: 'Login successfull ' + r.data.message,
      })
      router.push('/')
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'Login catch ' + e,
      })
    })
}
</script>
