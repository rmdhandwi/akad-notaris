export const useFormatTanggal = () =>
{
    const formatToDMY = (tanggal, errorMsg = 'Tidak ada tanggal') =>
    {
        if (tanggal) {
            const [tahun, bulan, hari] = tanggal.split("-")
            return `${hari}/${bulan}/${tahun}`
        }

        else {return errorMsg}
    }

    return {
        formatToDMY,
    }
}
