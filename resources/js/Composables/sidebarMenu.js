export const adminMenu = [
    { label: "Dashboard", icon: "pi pi-home", route: "admin.dashboard" },
    { label: "Kategori Layanan", icon: "pi pi-briefcase", route: "admin.layanan.kategori.index"},
    { label: "Jenis Layanan", icon: "pi pi-briefcase", route: "admin.layanan.jenis.index"},
    { label: "Data Berkas", icon: "pi pi-book", route: "admin.berkas.index"},
    { label: "Data Staf", icon: "pi pi-user", route: "admin.users.staf.index"},
    { label: "Data Notaris", icon: "pi pi-user", route: "admin.users.notaris.index"},
]

export const notarisMenu = [
    { label: "Dashboard", icon: "pi pi-home", route: "notaris.dashboard" },
    { label: "Jadwal", icon: "pi pi-calendar", route: "notaris.layanan.jadwal.index"},
]
