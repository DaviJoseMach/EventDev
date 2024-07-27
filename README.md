


# EventDev

EventDev is a web application designed to list and manage tech events. Users can filter events by entry fee, state, month, and status. The application is built using a robust stack including PHP, Laravel, JavaScript, HTML, CSS (Bootstrap), and MySQL and is totally open-source.

## Features

- **Event Listing**: View a comprehensive list of tech events.
- **Filtering**: Filter events by entry fee, state, month, and status.
- **Event Details**: Click on an event to view detailed information in a modal.
- **Responsive Design**: Fully responsive design using Bootstrap.
- **Status Badge**: Events are marked as "Ativo" (Active) or "Encerrado" (Closed) based on their dates.

## Technologies Used

- **Backend**:
  - PHP
  - Laravel

- **Frontend**:
  - HTML
  - CSS (Bootstrap)
  - JavaScript

- **Database**:
  - MySQL

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/DaviJoseMach/EventDev
   cd eventdev
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Set up the environment variables**:
   Create a `.env` file and add your database credentials and other necessary environment variables.
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Run the migrations**:
   ```bash
   php artisan migrate
   ```

5. **Serve the application**:
   ```bash
   php artisan serve
   npm run dev
   ```

6. **Or run directly with XAMPP**:

## Usage

1. **Access the application**:
   Open your web browser and navigate to `http://localhost:8000`.

2. **Filtering Events**:
   - Select filters for entry fee, state, month, or status and click "Filtrar" to view the filtered events.

3. **View Event Details**:
   - Click on an event card to view detailed information in a modal.

## Screenshots

### Home
![Event List](https://cdn.discordapp.com/attachments/1133480741074907195/1266891532007379086/image.png?ex=66a6cc2e&is=66a57aae&hm=c879cb0697225783c268a6091a924aa3fc3685d1537e0dd6ae4ca298fb8c35ac&)

### Event Details/List

![Event Details](https://cdn.discordapp.com/attachments/1133480741074907195/1266891753487728773/image.png?ex=66a6cc63&is=66a57ae3&hm=113c5a55eeead3645b26f4e0b5902c11301de55468139ab6fc49d7f16f3a8515&)
![Event Details](https://media.discordapp.net/attachments/1133480741074907195/1266891840934772848/image.png?ex=66a6cc78&is=66a57af8&hm=3f8aeba470c78d3bc8fee4ef8f3af939de4e3c3c4a2516757fbd89bc27688a3f&=&format=webp&quality=lossless&width=1348&height=701)
## Contributing

Contributions are welcome! Please fork this repository and submit a pull request for any features, bug fixes, or improvements.

1. **Fork the repository**
2. **Create a new branch**: `git checkout -b feature-branch`
3. **Commit your changes**: `git commit -m 'Add new feature'`
4. **Push to the branch**: `git push origin feature-branch`
5. **Submit a pull request**

If you find any bugs or errors on the site, please open an issue or contact me on Twitter.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

- **Twitter**: [@Davvzin](https://x.com/davvzin)
- **GitHub**: [Davi](https://github.com/DaviJoseMach)

---

*Developed with ❤️ by [Davi José](https://x.com/davvzin)*
 ---
