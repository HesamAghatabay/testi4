<template>
  <q-layout view="hHh Lpr fFf">
    <!-- Be sure to play with the Layout demo on docs -->

    <!-- (Optional) The Header -->
    <q-header elevated>
      <q-toolbar>
        <q-btn flat round dense icon="menu" @click="toggleLeftDrawer" />

        <q-toolbar-title> Header </q-toolbar-title>
        <q-btn to="/">Index Page</q-btn>
      </q-toolbar>

      <!-- <q-tabs>
        <q-route-tab icon="map" to="/your/route" replace label="One Tab" />
        <q-route-tab icon="assignment" to="/some/other/route" replace label="Other Tab" />
      </q-tabs> -->
    </q-header>

    <!-- (Optional) The Footer -->
    <q-footer>
      <!-- <q-tabs switch-indicator>
        <q-route-tab icon="map" to="/your/route" replace label="One Tab" />
        <q-route-tab icon="assignment" to="/some/other/route" replace label="Other Tab" />
      </q-tabs> -->

      <q-toolbar>
        <q-btn flat round dense icon="menu" @click="toggleLeftDrawer" />
        <q-toolbar-title> Footer </q-toolbar-title>
      </q-toolbar>
    </q-footer>

    <!-- (Optional) A Drawer; you can add one more with side="right" or change this one's side -->
    <q-drawer v-model="leftDrawerOpen" side="left" bordered class="bg-grey-2">
      <!-- QScrollArea is optional -->
      <q-scroll-area class="fit q-pa-sm">
        <!-- Content here -->
      </q-scroll-area>
    </q-drawer>

    <q-page-container>
      <!-- This is where pages get injected -->
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref } from 'vue'

const leftDrawerOpen = ref(false)

function toggleLeftDrawer() {
  leftDrawerOpen.value = !leftDrawerOpen.value
}
</script>
