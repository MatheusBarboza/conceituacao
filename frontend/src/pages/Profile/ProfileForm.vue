<template>
  <q-page padding>
    <h1>{{ isEditMode ? "Edit Profile" : "Create Profile" }}</h1>
    <q-form @submit.prevent="onSubmit">
      <q-input v-model="name" label="Name" :rules="[required(), min(3), max(100)]"/>
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
import service from "src/services/profile";
import { useRouter, useRoute } from "vue-router";
import { useQuasar } from "quasar";
import { mapValidations } from "src/utils/validations";

export default defineComponent({
  name: "UserForm",

  setup() {
    const $q = useQuasar();
    const name = ref("");
    const router = useRouter();
    const route = useRoute();
    const userId = computed(() => route.params.id);
    const isEditMode = computed(() => !!userId.value);

    const fetchUser = async () => {
      if (isEditMode.value) {
        try {
          service.find(userId.value).then((response) => {
            name.value = response.data.name;
          });
        } catch (error) {
          console.error("Failed to fetch profile", error);
        }
      }
    };

    const goBack = () => {
      router.push("/profiles");
    };

    const onSubmit = async () => {
      try {
        const action = isEditMode.value ? "update" : "create"
        const data = {
          name: name.value,
        }

        if (isEditMode.value)
          data.id = userId.value

        service[action](data)
          .then(() => {
            const message = isEditMode.value
              ? "Profile updated successfully"
              : "Profile created successfully";
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

    onMounted(() => {
      fetchUser();
    });

    return {
      name,
      onSubmit,
      isEditMode,
      goBack,
      ...mapValidations(["required", "min", "max"]),
    };
  },
});
</script>
