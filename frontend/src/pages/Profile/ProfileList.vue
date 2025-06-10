<template>
<q-page padding>
    <h1>Profile List</h1>
    <q-btn to="/profiles/create" color="primary" label="Create New Profile" class="q-mb-md" />

    <q-list bordered separator>
    <q-item v-for="profile in profiles" :key="profile.id">
        <q-item-section>
        <q-item-label>{{ profile.name }}</q-item-label>
        </q-item-section>
        <q-item-section side>
        <div class="row q-gutter-sm">
            <q-btn :to="`/profiles/${profile.id}/edit`"
                color="primary"
                icon="edit"/>
            <q-btn color="negative"
                icon="delete"
                @click="deleteProfile(profile.id)"/>
        </div>
        </q-item-section>
    </q-item>
    </q-list>
</q-page>
</template>
  
<script>
import { defineComponent, ref, onMounted } from 'vue'
import service from 'src/services/profile'
import { useQuasar } from 'quasar'

  
export default defineComponent({
    name: 'UserList',
  
    setup() {
        const profiles = ref([]);
        const $q = useQuasar()

        const fetchProfiles = async () => {
            service.all().then((response) => {
                profiles.value = response.data;
            })
            .catch((error) => {
                $q.notify({
                    type: 'negative',
                    message: error.response.data.message
                })
            });
        }

        const deleteProfile = async (id) => {
            service.delete(id).then(() => {
                fetchProfiles();
                $q.notify({
                    type: 'positive',
                    message: 'Profile deleted successfully'
                })
            })
            .catch((error) => {
                $q.notify({
                    type: 'negative',
                    message: error.response.data.message
                })
            });
        }

        onMounted(() => {
            fetchProfiles()
        })

        return {
            profiles,
            deleteProfile
        }
    },
  });
  </script>