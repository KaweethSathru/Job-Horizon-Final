document.addEventListener("DOMContentLoaded", function () {
    const applicantNotificationToggle = document.getElementById("applicantNotificationToggle");
    const applicantNotificationPanel = document.getElementById("applicantNotificationPanel");
    const applicantNotifyCount = document.querySelector(".notify");

    if (applicantNotificationToggle && applicantNotificationPanel) {
        // Toggle notification panel visibility
        applicantNotificationToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            applicantNotificationPanel.style.display = applicantNotificationPanel.style.display === "block" ? "none" : "block";
        });

        // Close panel if clicked outside
        document.addEventListener("click", function (e) {
            if (!applicantNotificationPanel.contains(e.target) && e.target !== applicantNotificationToggle) {
                applicantNotificationPanel.style.display = "none";
            }
        });

        // Handle notification item clicks
        applicantNotificationPanel.addEventListener("click", function (e) {
            const notificationItem = e.target.closest(".notification-item");
            if (notificationItem) {
                const applicationId = notificationItem.getAttribute("data-id");

                // Mark as read in the database
                fetch("mark_read.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `application_id=${applicationId}&is_applicant=1`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the notification item and update count
                        notificationItem.remove();
                        const currentCount = parseInt(applicantNotifyCount.textContent, 10);
                        if (currentCount > 0) {
                            applicantNotifyCount.textContent = currentCount - 1;
                        }
                    } else {
                        console.error("Failed to update read status:", data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    } else {
        console.error("Applicant notification elements are not properly identified.");
    }
});
