<script setup>
const props = defineProps(["equipmentTypes"]);
const headers = [
  {
    title: "#",
    align: "start",
    sortable: false,
    key: "id",
  },
  { title: "Name", align: "end", key: "name" },
  { title: "Slug", align: "end", key: "slug" },
];
const itemsPerPage = 5;
</script>

<template>
  <VDataTable
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="equipmentTypes"
    item-value="name"
    class="elevation-1"
  ></VDataTable>
  <VTable>
    <thead>
      <tr>
        <th class="text-uppercase">#</th>
        <th>Name</th>
        <th>slug</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="equipmentType in equipmentTypes" :key="equipmentType.id">
        <td>
          {{ equipmentType.id }}
        </td>
        <td class="text-center">
          {{ equipmentType.name }}
        </td>
        <td class="text-center">
          {{ equipmentType.slug }}
        </td>
      </tr>
    </tbody>
  </VTable>
</template>
