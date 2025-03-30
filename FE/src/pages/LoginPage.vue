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
import { api } from 'src/boot/axios'
import { ref } from 'vue'

const mobile = ref('')
const password = ref('')
const isPwd = ref(true)

function login() {
  api.post('oauth/token', {
    grant_type: 'password',
    client_id: 2,
    client_secret: 'EzB4uJuRnPClYPOt3GS82YntZyYw4QjwVHTdQAtk',
    username: mobile.value,
    password: password.value,
    scope: '*',
  })
}
</script>
