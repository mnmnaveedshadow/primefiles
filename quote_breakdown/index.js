const table_1 = document.getElementById("table--1");
const table_2 = document.getElementById("table--2");
const table_3 = document.getElementById("table--3");
const table_4 = document.getElementById("table--4");

let table_1_items = [
  {
    no_of_packages: 10,
    length: 100,
    width: 100,
    height: 100,
    volume: 116.67,
    weight: 10,
  },
  {
    no_of_packages: 10,
    length: 100,
    width: 100,
    height: 100,
    volume: 116.67,
    weight: 10,
  },
  {
    no_of_packages: 10,
    length: 100,
    width: 100,
    height: 100,
    volume: 116.67,
    weight: 10,
  },
  {
    no_of_packages: 10,
    length: 100,
    width: 100,
    height: 100,
    volume: 116.67,
    weight: 10,
  },
];

let table_2_items = [
  {
    vendor: "DNATA",
    airline: "Saudi Airlines",
    description: "Air Frieght",
    chargeAmount: 5.75 * 166.67,
    totalAmount: 958.3525,
    currency: "AED",
    uom: "Per Kg",
    validity: "2023-12-31",
  },
  {
    vendor: "DNATA",
    airline: "Saudi Airlines",
    description: "Air Frieght",
    chargeAmount: 5.75 * 166.67,
    totalAmount: 958.3525,
    currency: "AED",
    uom: "Per Kg",
    validity: "2023-12-31",
  },
  {
    vendor: "DNATA",
    airline: "Saudi Airlines",
    description: "Air Frieght",
    chargeAmount: 5.75 * 166.67,
    totalAmount: 958.3525,
    currency: "AED",
    uom: "Per Kg",
    validity: "2023-12-31",
  },
];

let table_3_items = [
  {
    country: "United Arab Enmirates",
    city: "Dubai",
    airport: "DXB",
    vendor: "DNATA",
    description: "Label Fee",
    charge: 0.31 * 10,
    totalCharge: 3.1,
    currency: "AED",
    uom: "Per Label",
    minimum: 31,
    validity: "2023-12-31",
  },
  {
    country: "United Arab Enmirates",
    city: "Dubai",
    airport: "DXB",
    vendor: "DNATA",
    description: "Label Fee",
    charge: 0.31 * 10,
    totalCharge: 3.1,
    currency: "AED",
    uom: "Per Label",
    minimum: 31,
    validity: "2023-12-31",
  },
  {
    country: "United Arab Enmirates",
    city: "Dubai",
    airport: "DXB",
    vendor: "DNATA",
    description: "Label Fee",
    charge: 0.31 * 10,
    totalCharge: 3.1,
    currency: "AED",
    uom: "Per Label",
    minimum: 31,
    validity: "2023-12-31",
  },
];

let table_4_items = [
  {
    country: "Saudi Arabia",
    city: "Riyadh",
    airport: "RUH",
    vendor: "Qarat Logistics",
    description: "Clearance Charge",
    charge: 500,
    totalCharge: 500,
    currency: "SAR",
    uom: "Per Shipment",
    minimum: 0,
    validity: "2023-12-31",
  },
  {
    country: "Saudi Arabia",
    city: "Riyadh",
    airport: "RUH",
    vendor: "Qarat Logistics",
    description: "Clearance Charge",
    charge: 500,
    totalCharge: 500,
    currency: "SAR",
    uom: "Per Shipment",
    minimum: 0,
    validity: "2023-12-31",
  },
  {
    country: "Saudi Arabia",
    city: "Riyadh",
    airport: "RUH",
    vendor: "Qarat Logistics",
    description: "Clearance Charge",
    charge: 500,
    totalCharge: 500,
    currency: "SAR",
    uom: "Per Shipment",
    minimum: 0,
    validity: "2023-12-31",
  },
];

for (let item of table_1_items) {
  table_1.innerHTML += `
    <tbody>
        <tr class="table-border-color">
            <td>${item.no_of_packages}</td>
            <td>${item.length}</td>
            <td>${item.width}</td>
            <td>${item.height}</td>
            <td>${item.volume}</td>
            <td>${item.weight}</td>
        </tr>
    </tbody>
`;
}

for (let item of table_2_items) {
  table_2.innerHTML += `
    <tbody>
        <tr class="table-border-color">
            <td>${item.vendor}</td>
            <td>${item.airline}</td>
            <td>${item.description}</td>
            <td>${item.chargeAmount}</td>
            <td>${item.totalAmount}</td>
            <td>${item.currency}</td>
            <td>${item.uom}</td>
            <td>${item.validity}</td>
        </tr>
    </tbody>
`;
}

for (let item of table_3_items) {
  table_3.innerHTML += `
    <tbody>
        <tr class="table-border-color">
            <td>${item.country}</td>
            <td>${item.city}</td>
            <td>${item.airport}</td>
            <td>${item.vendor}</td>
            <td>${item.description}</td>
            <td>${item.charge}</td>
            <td>${item.totalCharge}</td>
            <td>${item.currency}</td>
            <td>${item.uom}</td>
            <td>${item.minimum}</td>
            <td>${item.validity}</td>
        </tr>
    </tbody>
`;
}

for (let item of table_4_items) {
  table_4.innerHTML += `
    <tbody>
        <tr class="table-border-color">
            <td>${item.country}</td>
            <td>${item.city}</td>
            <td>${item.airport}</td>
            <td>${item.vendor}</td>
            <td>${item.description}</td>
            <td>${item.charge}</td>
            <td>${item.totalCharge}</td>
            <td>${item.currency}</td>
            <td>${item.uom}</td>
            <td>${item.minimum}</td>
            <td>${item.validity}</td>
        </tr>
    </tbody>
`;
}
