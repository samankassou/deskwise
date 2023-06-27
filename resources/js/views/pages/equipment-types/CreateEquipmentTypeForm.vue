<script setup>
import axios from "@axios";
defineEmits(["typeAdded", "closeDialog"]);
const Name = ref("");
const loading = ref(false);
const errorMessage = ref("");
const submitForm = async () => {
  loading.value = true;

  try {
    await axios
      .post("equipment-types", { name: Name.value })
      .then((response) => {
        emit("closeDialog");
        //console.log(response);
      });
  } catch (error) {
    errorMessage.value = error?.response?.data?.message;
  } finally {
    loading.value = false;
  }
};
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
          <VBtn type="submit" :loading="loading">Create</VBtn>
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
