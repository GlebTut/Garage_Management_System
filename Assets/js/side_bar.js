

document.addEventListener("DOMContentLoaded", () => {
    // ✅ Select all main menu items
    let main_menus = document.querySelectorAll(".main_menu");

    main_menus.forEach(menu => {
        menu.addEventListener("click", (e) => {
            e.preventDefault(); // Stop default link behavior

            // ✅ Get the submenu next to the clicked menu
            let sub_menu = menu.nextElementSibling;

            // ✅ Check if the submenu exists (some menus don’t have submenus)
            if (sub_menu && sub_menu.classList.contains("submenu")) {
                let isOpen = sub_menu.classList.contains("show");

                // ✅ Close all other submenus
                document.querySelectorAll(".submenu").forEach(sub => sub.classList.remove("show"));

                // ✅ Toggle the clicked submenu (show if it was hidden, hide if it was open)
                if (!isOpen) {
                    sub_menu.classList.add("show");
                }
            }
        });
    });
});
