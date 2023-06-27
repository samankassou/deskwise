<script setup>
const Name = ref("");
</script>

<template>
  <VForm @submit.prevent="() => {}">
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
              placeholder="Name"
              persistent-placeholder
            />
          </VCol>
        </VRow>
      </VCol>

      <!-- 👉 submit and reset button -->
      <VCol offset-md="3" cols="12" md="9" class="d-flex gap-4">
        <VBtn type="submit"> Submit </VBtn>
        <VBtn color="secondary" variant="tonal" type="reset"> Reset </VBtn>
      </VCol>
    </VRow>
  </VForm>
</template>
