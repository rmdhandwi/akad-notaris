import { useToast } from "primevue/usetoast"

export const useNotification = () => {
    const toast = useToast()

    const showToast = (notif_message, notif_status = "success", notif_duration = 3000) => {
        setTimeout(() =>
        {
            toast.add({
                closable : true,
                severity: notif_status, // 'success', 'info', 'warn', 'error'
                summary: "Notifikasi",
                detail: notif_message,
                life: notif_duration,
                group: "br",
            });
        }
        ,1000)
    };

    return { showToast }
};
