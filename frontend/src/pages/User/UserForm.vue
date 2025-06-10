<template>
  <q-page padding>
    <h1>{{ isEditMode ? "Edit User" : "Create User" }}</h1>
    <q-form @submit.prevent="onSubmit">
      <q-input
        v-model="name"
        label="Name"
        :rules="[required(), min(3), max(100)]"
      />
      <q-input
        v-model="email"
        label="Email"
        type="email"
        :rules="[required(), validEmail()]"
      />
      <q-input
        v-model="password"
        v-if="!isEditMode"
        label="Password"
        type="password"
        :rules="[required(), min(8)]"
      />
      <q-input
        v-model="password_confirmation"
        v-if="!isEditMode"
        label="Confirm Password"
        type="password"
        :required="!isEditMode"
        :rules="[confirmPassword]"
      />

      <q-select
        v-model="profiles"
        v-if="isAdmin"
        multiple
        label="Profiles"
        :options="profileOptions"
        use-chips
        map-options
        option-label="name"
        option-value="id"
        emit-value
      />

      <div class="q-mt-md row q-gutter-x-sm">
        <q-btn
          icon="arrow_back"
          color="negative"
          class="q-mt-md"
          @click="goBack"
        />
        <q-btn
          type="submit"
          color="primary"
          :label="isEditMode ? 'Update' : 'Create'"
          class="q-mt-md"
        />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted, computed } from "vue";
import service from "src/services/user";
import serviceProfile from "src/services/profile";
import { useRouter, useRoute } from "vue-router";
import { useQuasar } from "quasar";
import { mapValidations } from "src/utils/validations";
import { useAuthStore } from "src/stores/auth";

export default defineComponent({
  name: "UserForm",

  setup() {
    const $q = useQuasar();
    const name = ref("");
    const email = ref("");
    const password = ref("");
    const password_confirmation = ref("");
    const profiles = ref([]);
    const profileOptions = ref([]);
    const router = useRouter();
    const route = useRoute();
    const userId = computed(() => route.params.id);
    const isEditMode = computed(() => !!userId.value);
    const isAdmin = computed(() => useAuthStore().isAdmin);
    const fetchUser = async () => {
      if (isEditMode.value) {
        try {
          service.find(userId.value).then((response) => {
            name.value = response.data.name;
            email.value = response.data.email;
            profiles.value = response.data.profiles.map((p) => p.id);
          });
        } catch (error) {
          console.error("Failed to fetch user", error);
        }
      }
    };

    const fetchProfiles = async () => {
      serviceProfile
        .all()
        .then((response) => {
          profileOptions.value = response.data;
        })
        .catch((error) => {
          $q.notify({
            type: "negative",
            message: error.response.data.message,
          });
        });
    };

    const goBack = () => {
      router.push("/users");
    };

    const onSubmit = async () => {
      try {
        const action = isEditMode.value ? "update" : "create";
        const data = {
          name: name.value,
          email: email.value,
          profiles_id: profiles.value,
        };

        if (!isEditMode.value) {
          data.password = password.value;
          data.password_confirmation = password_confirmation.value;
        } else {
          data.id = userId.value;
        }

        service[action](data)
          .then(() => {
            const message = isEditMode.value
              ? "User updated successfully"
              : "User created successfully";
            $q.notify({
              type: "positive",
              message,
            });
            goBack();
          })
          .catch((error) => {
            $q.notify({
              type: "negative",
              message: error.response.data.message,
            });
          });
      } catch (error) {
        console.error("Failed to submit form", error);
      }
    };

    const confirmPassword = () => {
      return password.value === password_confirmation.value
        ? true
        : "Passwords do not match";
    };

    onMounted(() => {
      fetchUser();
      fetchProfiles();
    });

    return {
      name,
      email,
      password,
      password_confirmation,
      profiles,
      profileOptions,
      onSubmit,
      isEditMode,
      goBack,
      confirmPassword,
      isAdmin,
      ...mapValidations(["required", "validEmail", "min", "max"]),
    };
  },
});
</script>
