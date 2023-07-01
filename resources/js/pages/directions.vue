<script setup>
import DeleteDirectionDialog from "@/views/pages/directions/DeleteDirectionDialog.vue";
import DirectionForm from "@/views/pages/directions/DirectionForm.vue";
import DirectionsTable from "@/views/pages/directions/DirectionsTable.vue";
import axios from "@axios";
const showDialog = ref(false);
const dialogMode = ref("create");
const showDeleteDialog = ref(false);
const loading = ref(false);
const currentId = ref(null);
const directions = ref([]);

const loadFromServer = async () => {
  loading.value = true;
  try {
    await axios.get("directions").then((response) => {
      directions.value = response.data;
    });
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const directionAdded = () => {
  showDialog.value = false;
  loadFromServer();
};
const directionUpdated = () => {
  showDialog.value = false;
  loadFromServer();
};
const deleteDirection = (id) => {
  currentId.value = id;
  showDeleteDialog.value = true;
};
const editDirection = (id) => {
  currentId.value = id;
  dialogMode.value = "edit";
  showDialog.value = true;
};
const createDirection = () => {
  currentId.value = null;
  dialogMode.value = "create";
  showDialog.value = true;
};
const directionDeleted = () => {
  showDeleteDialog.value = false;
  loadFromServer();
};

loadFromServer();
</script>

<template>
  <VRow>
    <VDialog v-model="showDeleteDialog" width="auto">
      <DeleteDirectionDialog
        :currentId="currentId"
        @direction-deleted="directionDeleted"
        @close-delete-dialog="showDeleteDialog = false"
      />
    </VDialog>

    <VCol cols="12">
      <VCard title="Directions">
        <VBtn color="primary mx-5" @click="createDirection"> Create </VBtn>
        <VDialog v-model="showDialog" width="auto">
          <DirectionForm
            :currentId="currentId"
            :dialogMode="dialogMode"
            @direction-added="directionAdded"
            @direction-updated="directionUpdated"
            @close-dialog="showDialog = false"
          />
        </VDialog>
        <DirectionsTable
          :directions="directions"
          :loading="loading"
          @delete-direction="deleteDirection"
          @edit-direction="editDirection"
        />
      </VCard>
    </VCol>
  </VRow>
</template>
