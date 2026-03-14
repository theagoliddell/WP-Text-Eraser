# 🚀 WP Text Eraser

**WP Text Eraser** is a lightweight WordPress plugin designed to dynamically hide specific words or phrases from your post content without modifying your database.


## 🛠️ Key Features

* **Non-Destructive Filtering:** The plugin uses the `the_content` filter to remove text only during page rendering. Your original database content remains untouched.
* **Simple Configuration:** A dedicated settings page allows you to list words or phrases to be erased—one per line.
* **Clean Output:** Automatically handles line breaks and ignores duplicate entries in your list.
* **Literal Matching:** Treats all input as literal text, ensuring that special characters (like `*`, `?`, or `[]`) are handled as plain text rather than regex patterns.
* **Admin Integration:** Easy access via **Settings → Text Eraser** and a direct "Settings" link on the WordPress Plugins page.

---

## 📂 Project Structure

The plugin is built with a modular 5-file architecture for clarity and performance:

* `wp-text-eraser.php`: Main bootstrap file, plugin headers, and initialization.
* `wp-text-eraser-options.php`: Handles WordPress option registration and data sanitization.
* `wp-text-eraser-filter.php`: Contains the logic for filtering content on the front-end.
* `wp-text-eraser-admin.php`: Manages the admin menu, settings page, and UI.
* `wp-text-eraser-utils.php`: Utility functions for string-to-array conversion and text escaping.

---

## ⚙️ Installation

1.  Upload the `PluginWP_TextEraser` folder to your `/wp-content/plugins/` directory.
2.  Activate the plugin through the **Plugins** menu in WordPress.
3.  Go to **Settings → Text Eraser**.
4.  Enter the words or phrases you want to remove (one per line) and click **Save Changes**.

---

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.
