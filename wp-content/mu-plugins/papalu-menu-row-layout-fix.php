<?php
/**
 * Plugin Name: PapaLu Menu Row Layout Fix
 * Description: Aligns restaurant menu items in true visual rows on menu pages.
 */

declare(strict_types=1);

add_action('wp_head', static function (): void {
    if (!is_page([370, 372])) {
        return;
    }
    ?>
    <!-- papalu-menu-row-layout-fix -->
    <script>
    (function () {
      function getActiveColumns(columns) {
        if (window.matchMedia('(max-width: 767px)').matches) return 1;
        if (window.matchMedia('(max-width: 1024px)').matches) return Math.min(2, columns.length);
        return Math.min(3, columns.length);
      }

      function resetHeights(columns) {
        columns.forEach(function (col) {
          const info = col.querySelector(':scope > .wp-block-uagb-info-box');
          if (info) info.style.minHeight = '';
          col.querySelectorAll(':scope > .wp-block-uagb-restaurant-menu-child').forEach(function (item) {
            item.style.minHeight = '';
          });
        });
      }

      function equalizeInfoBoxHeights(columns, activeColumns) {
        if (activeColumns <= 1) return;
        let maxInfoHeight = 0;
        for (let i = 0; i < activeColumns; i++) {
          const info = columns[i].querySelector(':scope > .wp-block-uagb-info-box');
          if (!info) continue;
          maxInfoHeight = Math.max(maxInfoHeight, info.getBoundingClientRect().height);
        }
        if (maxInfoHeight <= 0) return;
        for (let i = 0; i < activeColumns; i++) {
          const info = columns[i].querySelector(':scope > .wp-block-uagb-info-box');
          if (info) info.style.minHeight = Math.ceil(maxInfoHeight) + 'px';
        }
      }

      function equalizeMenuRows(columns, activeColumns) {
        if (activeColumns <= 1) return;
        const rows = [];
        for (let i = 0; i < activeColumns; i++) {
          rows.push(Array.from(columns[i].querySelectorAll(':scope > .wp-block-uagb-restaurant-menu-child')));
        }
        const maxRowCount = rows.reduce(function (max, col) {
          return Math.max(max, col.length);
        }, 0);

        for (let rowIndex = 0; rowIndex < maxRowCount; rowIndex++) {
          let maxHeight = 0;
          rows.forEach(function (col) {
            if (!col[rowIndex]) return;
            maxHeight = Math.max(maxHeight, col[rowIndex].getBoundingClientRect().height);
          });
          if (maxHeight <= 0) continue;
          rows.forEach(function (col) {
            if (!col[rowIndex]) return;
            col[rowIndex].style.minHeight = Math.ceil(maxHeight) + 'px';
          });
        }
      }

      function applyRowLayout() {
        const parents = Array.from(document.querySelectorAll('.wp-block-uagb-container')).filter(function (el) {
          return el.querySelectorAll(':scope > .wp-block-uagb-restaurant-menu').length >= 2;
        });

        parents.forEach(function (parent) {
          const columns = Array.from(parent.querySelectorAll(':scope > .wp-block-uagb-restaurant-menu'));
          if (columns.length < 2) return;

          const activeColumns = getActiveColumns(columns);
          resetHeights(columns);
          equalizeInfoBoxHeights(columns, activeColumns);
          equalizeMenuRows(columns, activeColumns);
        });
      }

      let raf = 0;
      function scheduleLayout() {
        if (raf) cancelAnimationFrame(raf);
        raf = requestAnimationFrame(function () {
          applyRowLayout();
          raf = 0;
        });
      }

      window.addEventListener('load', scheduleLayout);
      window.addEventListener('resize', scheduleLayout);
      scheduleLayout();
    })();
    </script>
    <?php
}, 1000);
