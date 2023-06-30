<script setup>
import axios from "@axios";
const props = defineProps(["currentId", "dialogMode"]);
const emit = defineEmits(["typeAdded", "closeDialog", "typeUpdated"]);
const Name = ref("");
const loading = ref(false);
const errorMessage = ref("");
const submitBtnTxt = computed(() => {
  return props.dialogMode == "create" ? "Create" : "Update";
});
const getEquipmentType = async () => {
  if (props.currentId == null) {
    return;
  }
  loading.value = true;
  try {
    await axios.get("equipment-types/" + props.currentId).then((response) => {
      Name.value = response.data?.name;
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
        .post("equipment-types", { name: Name.value })
        .then((response) => {
          console.log(response);
          emit("typeAdded");
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
        .put("equipment-types/" + props.currentId, { name: Name.value })
        .then((response) => {
          console.log(response);
          emit("typeUpdated");
        });
    } catch (error) {
      errorMessage.value = error?.response?.data?.message;
    } finally {
      loading.value = false;
    }
  }
};
getEquipmentType();
</script>

<template>
  <VCard class="px-5 py-5">
    <VForm @submit.prevent="submitForm">
      <VRow>
        <VCol cols="12">
          <VRow no-gutters>
            <!-- 👉 First Name -->
            <VCol cols="12" md="3">
              <label for="Name">Name</label>
            </VCol>

            <VCol cols="12" md="9">
              <VTextField
                id="Name"
                v-model="Name"
                :error-messages="[errorMessage]"
                placeholder="Name"
                hint="Enter a name for your equipment type"
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
