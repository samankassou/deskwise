<script setup>
import DeleteDepartmentDialog from "@/views/pages/departments/DeleteDepartmentDialog.vue";
import DepartmentForm from "@/views/pages/departments/DepartmentForm.vue";
import DepartmentsTable from "@/views/pages/departments/DepartmentsTable.vue";
import axios from "@axios";
const showDialog = ref(false);
const dialogMode = ref("create");
const showDeleteDialog = ref(false);
const loading = ref(false);
const currentId = ref(null);
const departments = ref([]);

const loadFromServer = async () => {
  loading.value = true;
  try {
    await axios.get("departments").then((response) => {
      departments.value = response.data;
    });
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const departmentAdded = () => {
  showDialog.value = false;
  loadFromServer();
};
const departmentUpdated = () => {
  showDialog.value = false;
  loadFromServer();
};
const deleteDepartment = (id) => {
  currentId.value = id;
  showDeleteDialog.value = true;
};
const editDepartment = (id) => {
  currentId.value = id;
  dialogMode.value = "edit";
  showDialog.value = true;
};
const createDepartment = () => {
  currentId.value = null;
  dialogMode.value = "create";
  showDialog.value = true;
};
const departmentDeleted = () => {
  showDeleteDialog.value = false;
  loadFromServer();
};

loadFromServer();
</script>

<template>
  <VRow>
    <VDialog v-model="showDeleteDialog" width="auto">
      <DeleteDepartmentDialog
        :currentId="currentId"
        @department-deleted="departmentDeleted"
        @close-delete-dialog="showDeleteDialog = false"
      />
    </VDialog>

    <VCol cols="12">
      <VCard title="Departments">
        <VBtn color="primary mx-5" @click="createDepartment"> Create </VBtn>
        <VDialog v-model="showDialog" width="auto">
          <DepartmentForm
            :currentId="currentId"
            :dialogMode="dialogMode"
            @department-added="departmentAdded"
            @department-updated="departmentUpdated"
            @close-dialog="showDialog = false"
          />
        </VDialog>
        <DepartmentsTable
          :departments="departments"
          :loading="loading"
          @delete-department="deleteDepartment"
          @edit-department="editDepartment"
        />
      </VCard>
    </VCol>
  </VRow>
</template>
