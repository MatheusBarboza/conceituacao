<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title> Quasar App </q-toolbar-title>

        <div>Quasar v{{ $q.version }}</div>
      </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" show-if-above bordered>
      <q-list>
        <q-item to="/" exact clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="home" />
          </q-item-section>

          <q-item-section>
            Home
          </q-item-section>
        </q-item>

        <q-item to="/users" exact clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="people" />
          </q-item-section>

          <q-item-section>
            Users
          </q-item-section>
        </q-item>

        <q-item v-show="isAdmin" to="/profiles" exact clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="add" />
          </q-item-section>

          <q-item-section>
            Profiles
          </q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent } from "vue";
import { useAuthStore } from "src/stores/auth";

export default defineComponent({
  name: "MainLayout",

  data() {
    return {
      leftDrawerOpen: false,
    };
  },

  computed: {
    isAdmin() {
      return useAuthStore().isAdmin;
    },
  },

  methods: {
    toggleLeftDrawer() {
      this.leftDrawerOpen = !this.leftDrawerOpen;
    },
  },
});
</script>
