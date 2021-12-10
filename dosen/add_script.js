function fetchMajors(val) {
  var majors = [];

  switch (val) {
    case 'Fakultas Teknologi Informasi':
      majors = ['67 - S1 Teknik Informatika'];
      break;
    case 'Fakultas Psikologi':
      majors = ['80 - S1 Psikologi'];
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

function fetchSubjects(val) {
  document.getElementById('select_subjects').innerHTML = '';
  document.getElementById('select_subjects').innerHTML += `
    <option disabled selected>Kode Matakuliah</option>`;

  $.ajax({
    type: 'post',
    url: 'add_kelas.php',
    data: {
      subject: val,
    },
    success: function (response) {
      console.log(response);

      document.getElementById('select_subjects').innerHTML += response;
    },
  });
}

$('.timepicker').timepicker({
  timeFormat: 'HH:mm',
  interval: 30,
  minTime: '7:00am',
  maxTime: '6:00pm',
  startTime: '7:00',
  dynamic: false,
  dropdown: true,
  scrollbar: true,
});
