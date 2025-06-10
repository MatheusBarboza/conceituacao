<template>
  <q-page class="flex flex-center">
    <q-card style="width: 500px">
      <q-card-section>
        <div class="text-h6">Login</div>
      </q-card-section>

      <q-card-section>
        <q-form @submit.prevent="onSubmit">
          <q-input v-model="email" label="Email" type="email" required />
          <q-input
            v-model="password"
            label="Password"
            type="password"
            required
          />

          <div class="q-mt-md">
            <q-btn label="Login" type="submit" color="primary" />
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import { ref } from "vue";
import { useQuasar } from "quasar";
import { useRouter } from "vue-router";
import { useAuthStore } from "stores/auth";
import service from "src/services/auth";

const $q = useQuasar();
const router = useRouter();
const authStore = useAuthStore();

const email = ref("");
const password = ref("");

const onSubmit = async () => {
  try {
    const response = await service.signIn({
      email: email.value,
      password: password.value,
    });
    authStore.setToken(response.data.access_token);
    authStore.setUser(response.data.user);
    router.push("/");
  } catch (error) {
    $q.notify({
      type: "negative",
      message: error.response.data.message,
    });
  }
};
</script>
