function fetchMajors(val) {
  var majors = [];

  switch (val) {
    case 'Fakultas Teknologi Informasi':
      majors = ['67 - S1 Teknik Informatika', '68 - S1 Sistem Informasi'];
      break;
    case 'Fakultas Psikologi':
      majors = ['80 - S1 Psikologi'];
      break;
    case 'Fakultas Bahasa dan Seni':
      majors = ['39 - S1 Sastra Inggris'];
      break;

    default:
      majors = [];
      break;
  }

  document.getElementById('select_progdi').innerHTML = '';
  document.getElementById('select_progdi').innerHTML += `
    <option disabled selected>Pilih Progdi</option>`;

  majors.forEach((major) => {
    document.getElementById('select_progdi').innerHTML += `
    <option value="${major}">${major}</option>
    `;
  });
}
