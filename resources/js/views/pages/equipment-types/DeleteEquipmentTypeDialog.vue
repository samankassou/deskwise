<script setup>
import axios from "@axios";
const props = defineProps({
  currentId: Number | null,
});
const emit = defineEmits(["typeDeleted", "closeDeleteDialog"]);
const loading = ref(false);
const errorMessage = ref("");
const DeleteType = async () => {
  loading.value = true;
  try {
    await axios
      .delete("equipment-types/" + props.currentId)
      .then((response) => {
        console.log(response);
        emit("typeDeleted");
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
      <VBtn variant="tonal" @click="DeleteType" :loading="loading"
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
