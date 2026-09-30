console.log("LSP UMLA Laravel aktif");

document.addEventListener("DOMContentLoaded", () => {

    /* =========================================
       HAMBURGER MENU
    ========================================= */

    const hamburger = document.getElementById("hamburger");
    const menu = document.getElementById("nav-menu");


    if (hamburger && menu) {

        hamburger.addEventListener("click", (event) => {

            event.stopPropagation();

            const isOpen = menu.classList.toggle("show");

            hamburger.classList.toggle("active", isOpen);

            hamburger.setAttribute(
                "aria-expanded",
                isOpen ? "true" : "false"
            );

        });


        /* Tutup menu ketika klik di luar navbar */

        document.addEventListener("click", (event) => {

            if (
                !menu.contains(event.target) &&
                !hamburger.contains(event.target)
            ) {

                menu.classList.remove("show");

                hamburger.classList.remove("active");

                hamburger.setAttribute(
                    "aria-expanded",
                    "false"
                );

            }

        });

    }



    /* =========================================
       DROPDOWN INFORMASI
    ========================================= */

    const dropdown = document.getElementById("information-dropdown");

    const dropdownToggle =
        document.getElementById("information-toggle");


    if (dropdown && dropdownToggle) {

        dropdownToggle.addEventListener("click", (event) => {

            /*
             * Pada mobile dropdown dibuka dengan klik.
             * Pada desktop tetap bisa menggunakan hover CSS.
             */

            if (window.innerWidth <= 768) {

                event.preventDefault();

                event.stopPropagation();

                dropdown.classList.toggle("open");

            }

        });

    }



    /* =========================================
       TUTUP MENU SETELAH LINK DIKLIK
    ========================================= */

    const menuLinks =
        document.querySelectorAll(
            ".nav-menu a:not(.dropdown-toggle)"
        );


    menuLinks.forEach((link) => {

        link.addEventListener("click", () => {

            if (window.innerWidth <= 768) {

                menu?.classList.remove("show");

                hamburger?.classList.remove("active");

                hamburger?.setAttribute(
                    "aria-expanded",
                    "false"
                );

            }

        });

    });



    /* =========================================
       RESET SAAT WINDOW DIRESIZE
    ========================================= */

    window.addEventListener("resize", () => {

        if (window.innerWidth > 768) {

            menu?.classList.remove("show");

            hamburger?.classList.remove("active");

            dropdown?.classList.remove("open");

            hamburger?.setAttribute(
                "aria-expanded",
                "false"
            );

        }

    });



    /* =========================================
       SLIDER SKEMA
    ========================================= */

    const skema = document.querySelector(".skema");

    const left =
        document.querySelector(".skema-btn.left");

    const right =
        document.querySelector(".skema-btn.right");


    if (skema && left && right) {

        left.addEventListener("click", () => {

            skema.scrollBy({
                left: -180,
                behavior: "smooth"
            });

        });


        right.addEventListener("click", () => {

            skema.scrollBy({
                left: 180,
                behavior: "smooth"
            });

        });

    }

});