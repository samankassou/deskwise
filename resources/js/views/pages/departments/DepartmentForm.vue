<script setup>
import axios from "@axios";
const props = defineProps(["currentId", "dialogMode"]);
const emit = defineEmits([
  "departmentAdded",
  "closeDialog",
  "departmentUpdated",
]);
const name = ref("");
const directionId = ref(null);
const direction = ref({
  id: 1,
  name: "",
});
const directions = ref([]);
const loading = ref(false);
const errorMessage = ref("");
const cardTitle = computed(() => {
  return props.dialogMode == "create" ? "Create Department" : "Edit Department";
});
const submitBtnTxt = computed(() => {
  return props.dialogMode == "create" ? "Create" : "Update";
});

const getDepartment = async () => {
  if (props.currentId == null) {
    return;
  }
  loading.value = true;
  try {
    await axios.get("departments/" + props.currentId).then((response) => {
      name.value = response.data?.name;
      directionId.value = response.data?.direction_id;
    });
  } catch (error) {
    errorMessage.value = error?.response?.data?.message;
  } finally {
    loading.value = false;
  }
};

const loadDirections = async () => {
  loading.value = true;
  try {
    await axios.get("directions").then((response) => {
      console.log(response.data);
      directions.value = response.data;
    });
  } catch (error) {
    errorMessage.value = error?.response?.data?.message;
  } finally {
    loading.value = false;
  }
};

const submitForm = async () => {
  loading.value = true;
  // creation
  if (props.dialogMode == "create") {
    try {
      await axios
        .post("departments", {
          name: name.value,
          direction_id: directionId.value,
        })
        .then(() => {
          emit("departmentAdded");
        });
    } catch (error) {
      errorMessage.value = error?.response?.data?.message;
    } finally {
      loading.value = false;
    }
  } else {
    // update
    try {
      await axios
        .put("departments/" + props.currentId, {
          name: name.value,
          direction_id: directionId.value,
        })
        .then(() => {
          emit("departmentUpdated");
        });
    } catch (error) {
      errorMessage.value = error?.response?.data?.message;
    } finally {
      loading.value = false;
    }
  }
};
getDepartment();
loadDirections();
</script>

<template>
  <VCol cols="12">
    <VCard :title="cardTitle">
      <VDivider />

      <VCardText>
        <!-- 👉 Form -->
        <VForm class="mt-6" @submit.prevent="submitForm">
          <VRow>
            <!-- 👉 Name -->
            <VCol cols="12">
              <VTextField
                id="name"
                label="Name"
                v-model="name"
                :error-messages="[errorMessage]"
                placeholder="Name"
                hint="Enter a name for the department"
                persistent-placeholder
                variant="outlined"
              />
            </VCol>

            <!-- 👉 Direction -->
            <VCol cols="12">
              <VSelect
                label="Direction"
                v-model="directionId"
                :items="directions"
                item-value="id"
                item-title="name"
                placeholder="Select Direction"
              />
            </VCol>
            <!-- 👉 Form Actions -->
            <VCol cols="12" class="d-flex flex-wrap gap-4">
              <VBtn type="submit" :loading="loading">{{ submitBtnTxt }}</VBtn>

              <VBtn
                color="secondary"
                variant="tonal"
                type="reset"
                @click.prevent="$emit('closeDialog')"
              >
                Cancel
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </VCol>
</template>
