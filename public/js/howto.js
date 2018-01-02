//var kakak = <?php return $kakak ?>;
var tour = new Tour({
    backdrop: true,
    steps: [{
        prev: -1,
        placement: "bottom",
        path: "/scrum_app/public/home",
        element: "#dashboard-tour",
        title: "Ini adalah Dashboard",
        content: "Berisi jumlah data yang ada di Aplikasi Scrum."
    }, {
        placement: "bottom",
        path: "/scrum_app/public/home",
        element: "#aplikasi-tour",
        title: "Aplikasi",
        content: "Buat aplikasi yang akan dikerjakan.",
        onShown: function() {
            $('#aplikasi-tour').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "right",
        path: "/scrum_app/public/aplikasi",
        element: "#tambah-aplikasi-tour",
        title: "Buat aplikasi",
        content: "Klik tombol TAMBAH untuk membuat aplikasi baru.",
        onShown: function() {
            $('#tambah-aplikasi-tour').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "right",
        path: "/scrum_app/public/aplikasi/create",
        element: "#kode-aplikasi-tour",
        title: "Kode Aplikasi",
        content: "Isi kode aplikasi dengan angka. ex:12345."
    }, {
        placement: "right",
        path: "/scrum_app/public/aplikasi/create",
        element: "#nama-aplikasi-tour",
        title: "Nama Aplikasi",
        content: "Isi nama aplikasi dengan nama aplikasi yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/aplikasi/create",
        element: "#simpan-aplikasi-tour",
        title: "Simpan",
        content: "Klik tombol SIMPAN untuk menyimpan aplikasi.",
        onShown: function() {
            $('#simpan-aplikasi-tour').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "bottom",
        path: "/scrum_app/public/aplikasi",
        element: "#backlog-tour",
        title: "Backlog",
        content: "Klik BACKLOG untuk membuat backlog baru.",
        onShown: function() {
            $('#backlog-tour').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "right",
        path: "/scrum_app/public/backlog",
        element: "#tambah-backlog-tour",
        title: "Tambah Backlog",
        content: "Klik TAMBAH untuk menambahkan backlog baru.",
        onShown: function() {
            $('#tambah-backlog-tour').click(function() {
                tour.next();
            });
        },
    }, {
        backdrop: false,
        placement: "right",
        path: "/scrum_app/public/backlog/create",
        element: "#backlog-pilih-aplikasi-tour",
        title: "Pilih Aplikasi",
        content: "Pilih aplikasi yang anda buat pada step sebelumnya."
    }, {
        placement: "right",
        path: "/scrum_app/public/backlog/create",
        element: "#nama-backlog-tour",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        placement: "top",
        path: "/scrum_app/public/backlog/create",
        element: "#demo-backlog-tour",
        title: "Demo Backlog",
        content: "Isi demo untuk backlog yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/backlog/create",
        element: "#catatan-backlog-tour",
        title: "Catatan Backlog",
        content: "Isi catatan jika ada."
    }, {
        backdrop: false,
        placement: "right",
        path: "/scrum_app/public/backlog/create",
        element: "#backlog-pilih-sprint-tour",
        title: "Pilih Sprint",
        content: "Lewati langkah ini jika belum membuat sprint."
    }, {
        placement: "right",
        path: "/scrum_app/public/backlog/create",
        element: "#buton",
        title: "Simpan Backlog",
        content: "Klik SIMPAN untuk menyimpan backlog yang anda buat.",
        onShown: function() {
            $('#buton').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "bottom",
        path: "/scrum_app/public/backlog",
        element: "#sprint-tour",
        title: "Sprint",
        content: "Klik SPRINT untuk membuat sprint baru.",
        onShown: function() {
            $('#sprint-tour').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "right",
        path: "/scrum_app/public/sprints",
        element: "#tambah-sprint-tour",
        title: "Tambah Sprint",
        content: "Klik SPRINT untuk menambahkan sprint baru.",
        onShown: function() {
            $('#tambah-sprint-tour').click(function() {
                tour.next();
            });
        },
    }, {
        backdrop: false,
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#datepicker",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#durasi_waktu",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        backdrop: false,
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#timepicker",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        backdrop: false,
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#sprint-pilih-team-tour",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#kode-sprint-tour",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#nama-sprint-tour",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#nilai-sp-tour",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#goal-tour",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }, {
        placement: "right",
        path: "/scrum_app/public/sprints/create",
        element: "#simpan-sprint-tour",
        title: "Simpan Sprint",
        content: "Klik SIMPAN untuk menyimpan backlog yang anda buat.",
        onShown: function() {
            $('#simpan-sprint-tour').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "bottom",
        path: "/scrum_app/public/sprints",
        element: "#sprint-backlog-tour",
        title: "Sprint Backlog",
        content: "Klik SPRINT untuk membuat sprint baru.",
        onShown: function() {
            $('#sprint-backlog-tour').click(function() {
                tour.next();
            });
        },
    }, {
        placement: "right",
        path: "/scrum_app/public/sprintbacklogs/4",
        element: "#tambah-sprintbacklog-tour",
        title: "Nama Backlog",
        content: "Isi nama backlog dengan nama backlog yang akan anda buat."
    }]
});
tour.start();
$('#start-tour').click(function() {
    tour.restart();
});