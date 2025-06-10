<template>
  <q-page padding>
    <h1>User List</h1>
    <q-btn
      to="/users/create"
      color="primary"
      label="Create New User"
      class="q-mb-md"
    />

    <q-list bordered separator>
      <q-item v-for="user in users" :key="user.id">
        <q-item-section>
          <q-item-label>{{ user.name }}</q-item-label>
          <q-item-label caption>
            <span
              v-for="profile in user.profiles"
              class="q-mr-sm"
              :key="user.id + profile.id"
              >{{ profile.name }}</span
            >
          </q-item-label>
        </q-item-section>
        <q-item-section side>
          <div class="row q-gutter-sm">
            <q-btn :to="`/users/${user.id}/edit`" color="primary" icon="edit" />
            <q-btn
              color="negative"
              icon="delete"
              @click="deleteUser(user.id)"
            />
          </div>
        </q-item-section>
      </q-item>
    </q-list>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import service from "src/services/user";
import { useQuasar } from "quasar";

export default defineComponent({
  name: "UserList",

  setup() {
    const users = ref([]);
    const $q = useQuasar();
    const fetchUsers = async () => {
      service
        .all()
        .then((response) => {
          users.value = response.data;
        })
        .catch((error) => {
          $q.notify({
            type: "negative",
            message: error.response.data.message,
          });
        });
    };

    const deleteUser = async (id) => {
      if (confirm("Are you sure you want to delete this user?")) {
        return;
      }

      service
        .delete(id)
        .then(() => {
          fetchUsers();
          $q.notify({
            type: "positive",
            message: "User deleted successfully",
          });
        })
        .catch((error) => {
          $q.notify({
            type: "negative",
            message: error.response.data.message,
          });
        });
    };

    onMounted(() => {
      fetchUsers();
    });

    return {
      users,
      deleteUser
    };
  },
});
</script>
