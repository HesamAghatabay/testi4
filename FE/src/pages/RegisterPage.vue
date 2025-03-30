<template>
  <q-page padding>
    <!-- content -->
    <h3>Register Page</h3>
    <div class="row">
      <div class="col-6">
        <q-input class="q-mx-lg" v-model="registerData.name" label="Name" outlined rounded />
        <q-input class="q-mx-lg" v-model="registerData.mobile" label="Mobile" outlined rounded />
      </div>
      <div class="col-6">
        <q-input
          class="q-mx-lg"
          v-model="registerData.password"
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
        <q-input
          class="q-mx-lg"
          v-model="confirmpassword"
          label="ConfirmPassword"
          outlined
          rounded
          :type="isPwdConfirm ? 'password' : 'text'"
        >
          <template v-slot:append>
            <q-icon
              :name="isPwdConfirm ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwdConfirm = !isPwdConfirm"
            />
          </template>
        </q-input>
      </div>
      <q-btn @click="register" class="q-ma-md" color="blue-8">Register</q-btn>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

const isPwd = ref(true)
const isPwdConfirm = ref(true)
const router = useRouter()
const confirmpassword = ref(null)
const registerData = reactive({
  name: null,
  mobile: null,
  password: null,
})

function register() {
  if (registerData.password == confirmpassword.value) {
    api
      .post('api/register', registerData)
      .then((r) => {
        Notify.create({
          type: 'positive',
          position: 'top',
          message: 'register successful ' + r.data.message,
        })
        router.push('/')
      })
      .catch((e) => {
        console.log(e)
        Notify.create({
          type: 'negative',
          position: 'top',
          message: 'register in cach ' + e,
        })
      })
  }
}
</script>
