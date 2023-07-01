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
const directions = ref([]);
const loading = ref(false);
const errorMessage = ref("");
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
  <VCard class="px-5 py-5">
    <VForm @submit.prevent="submitForm">
      <VRow>
        <VCol cols="12">
          <VRow no-gutters>
            <!-- 👉 Name -->
            <VCol cols="12" md="3">
              <label for="name">name</label>
            </VCol>

            <VCol cols="12" md="9">
              <VTextField
                id="name"
                v-model="name"
                :error-messages="[errorMessage]"
                placeholder="Name"
                hint="Enter a name for the department"
                persistent-placeholder
                variant="outlined"
              />
            </VCol>
          </VRow>
        </VCol>

        <!-- 👉 submit and reset button -->
        <VCol offset-md="3" cols="12" md="9" class="d-flex gap-4">
          <VBtn type="submit" :loading="loading">{{ submitBtnTxt }}</VBtn>
          <VBtn
            color="secondary"
            variant="tonal"
            type="reset"
            @click="$emit('closeDialog')"
          >
            Cancel
          </VBtn>
        </VCol>
      </VRow>
    </VForm>
  </VCard>
</template>
