document.addEventListener("DOMContentLoaded", function () {
    const companyNotificationToggle = document.getElementById("companyNotificationToggle");
    const companyNotificationPanel = document.getElementById("companyNotificationPanel");
    const companyNotifyCount = document.querySelector(".notify");

    if (companyNotificationToggle && companyNotificationPanel) {
        // Toggle notification panel visibility
        companyNotificationToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            companyNotificationPanel.style.display = companyNotificationPanel.style.display === "block" ? "none" : "block";
        });

        // Close panel if clicked outside
        document.addEventListener("click", function (e) {
            if (!companyNotificationPanel.contains(e.target) && e.target !== companyNotificationToggle) {
                companyNotificationPanel.style.display = "none";
            }
        });

        // Handle notification item clicks
        companyNotificationPanel.addEventListener("click", function (e) {
            const notificationItem = e.target.closest(".notification-item");
            if (notificationItem) {
                const applicationId = notificationItem.getAttribute("data-id");

                // Mark as read in the database
                fetch("mark_read.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `application_id=${applicationId}&is_applicant=0`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the notification item and update count
                        notificationItem.remove();
                        const currentCount = parseInt(companyNotifyCount.textContent, 10);
                        if (currentCount > 0) {
                            companyNotifyCount.textContent = currentCount - 1;
                        }

                        // Redirect to view details if link exists
                        const viewLink = notificationItem.querySelector('.view-application-link');
                        if (viewLink) {
                            window.location.href = viewLink.href;
                        }
                    } else {
                        console.error("Failed to update read status:", data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    } else {
        console.error("Company notification elements are not properly identified.");
    }
});
