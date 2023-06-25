<script setup>
import axios from "@axios";
import "ag-grid-community/styles/ag-grid.css"; // Core grid CSS, always needed
import "ag-grid-community/styles/ag-theme-alpine.css"; // Optional theme CSS
import { AgGridVue } from "ag-grid-vue3"; // the AG Grid Vue Component
import { onMounted, reactive, ref } from "vue";

// definitions
const gridApi = ref(null); // for accessing Grid's API
const equipmentTypes = reactive({});
// Each Column Definition results in one Column.
const columnDefs = reactive({
  value: [
    { field: "id", checkboxSelection: true },
    {
      headerName: "Name",
      field: "name",
      sortable: true,
      filter: true,
    },
    { field: "slug" },
  ],
});
// DefaultColDef sets props common to all Columns
const defaultColDef = {
  sortable: true,
  filter: true,
  flex: 1,
};

// Obtain API from grid's onGridReady event
const onGridReady = (params) => {
  gridApi.value = params.api;
};
const cellWasClicked = (event) => {
  // Example of consuming Grid Event
  console.log("cell was clicked", event);
};
const fetchEquipmentTypes = async () => {
  try {
    await axios.get("equipment-types").then((response) => {
      equipmentTypes.value = response.data.data;
    });
  } catch (error) {
    console.error(error);
  }
};
// Example load data from server
onMounted(() => {
  fetchEquipmentTypes();
});
</script>

<template>
  <AgGridVue
    class="ag-theme-alpine px-5 py-5"
    style="height: 400px"
    :columnDefs="columnDefs.value"
    :rowData="equipmentTypes.value"
    :defaultColDef="defaultColDef"
    rowSelection="multiple"
    animateRows="true"
    @cell-clicked="cellWasClicked"
    @grid-ready="onGridReady"
  >
  </AgGridVue>
</template>
