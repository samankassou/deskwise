<script setup>
import axios from "@axios";
const props = defineProps({
  currentId: Number | null,
});
const emit = defineEmits(["directionDeleted", "closeDeleteDialog"]);
const loading = ref(false);
const errorMessage = ref("");
const DeleteDirection = async () => {
  loading.value = true;
  try {
    await axios.delete("directions/" + props.currentId).then((response) => {
      console.log(response);
      emit("directionDeleted");
    });
  } catch (error) {
    errorMessage.value = error?.response?.data?.message;
  } finally {
    loading.value = false;
  }
};
</script>

<template>
  <VCard title="Delete item" class="px-5 py-5">
    <VCardText> Do you really want to delete this item? </VCardText>
    <VCardActions>
      <VBtn variant="tonal" @click="DeleteDirection" :loading="loading"
        >Yes, Delete</VBtn
      >
      <VBtn
        color="secondary"
        variant="text"
        type="reset"
        @click="$emit('closeDeleteDialog')"
      >
        Cancel
      </VBtn>
    </VCardActions>
  </VCard>
</template>
