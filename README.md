# Online-Grocery-Store
A simple implement of database used in a website, supposing the user is an online grocery store
Actually it is a project we have done in our database management class.
Our group's another great members are Erin and Xiaoshi. A super team! Haha :D

1.Overview

The website offers a service to have groceries delivered to a customer's address. In order for this service to function, the system must have various users and permissions. The system has four main roles including customer, store/region manager, salesperson, and admin. As an overview of how the system works with these user roles, the first page to the system is a login screen. According to user name and user role which are stored in the user table, user can be redirected log in to the appropriate screen. For example, if the user's role is a customer, then they will be taken to a front-end view where they can do tasks such as browse and purchase groceries. However, if the user's role is a store/region manager, salesperson, or admin, then they will be redirected to a back-end view. These views are discussed later in the report. Each role needs to be broken down into specific permissions.

2.Customer Role

Generally, a user is considered a customer and is given customer permissions after they sign up to the delivery service. A customer is able to create, view, and edit their own profile with fields that include first name, last name, address, email, phone number, and more. Then the user can browse the database of products that the delivery service offers through the front-end. The navigation is based on the product categories. Customers can search and view products in the system by name, category, description, keywords, price, brand, rating, and promotion. They can also see a detailed page for each product, including the product's name, description, rating, price, brand, and category.
After browsing the website and seeing what products are available, the customer can use the shopping cart. The shopping cart allows the customer to add and delete goods into their digital cart. They can also change the quantity of the product from the shopping cart page. After the customer shops on the website, they have the ability to make the order by confirming to buy the goods in the cart. There is a check-out process they go through, and then they have permissions to browse their own transactions in the transaction history. Finally, the customer can add ratings to the products so that their shopping experience is tailored to their favorite and least favorite purchases.

3.Store/Region Manager Role

The goal of the website is to deliver groceries to a customer's door, so there must be a local warehouse/store that is managed. Each store will have a store manager to manage the store’s products as well as view the transactions related to the store. Similarly, location will need a region manager to maintain stock, transactions, products and more. Store managers and region managers can see the back-end view of the website in order to manage their stores’ warehouse and deliveries. They can make changes to the product information, inventory, customer, transaction, and salesperson (delivery person). 

4.Salesperson Role

A salesperson for this application is a delivery person. This person will deliver groceries from the warehouse to the customer's door. They can log into the back-end view of the website to browse the transactions and products. A salesperson can also view certain reports, specifically about their individual sales.

5.Admin Role

The admin role is meant for those who oversee the entire business system, including database. They can add, edit, and delete every aspect to the grocery delivery business website. When they login, admins see the back-end and can approve managers' accounts as well as have all access to inventory, customers, transactions, salespersons, and reports.
