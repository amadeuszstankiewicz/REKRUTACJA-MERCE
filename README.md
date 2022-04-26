# Vending Machine

Console application that simulates the operation of vending machine.

## Install project
For the starting point, just check out the git project:
```
$ git clone https://github.com/amadeuszstankiewicz/VendingMachine.git
```
Then run command:
```
$ composer install
```

## Program usage
To run the program, go to your project folder and type the command:
```
$ php app.php
```
The program accepts `N, D, Q, DOLLAR` commands that represent money being thrown in.

After inserting the money, you can use the `GET-A, GET-B, GET-C, RETURN-MONEY` actions to buy items `A, B, C` or return the money.
Product prices are:
```
A - 0.65$
B - 1.00$
C - 1.50$
```
One of each product is added at the beginning of the program.

### Example program usage
```
--- Vending machine program (to exit, type exit) ---
Input: DOLLAR
Current balance: 1.00 (DOLLAR)
Input: Q
Current balance: 1.25 (DOLLAR, Q)
Input: D
Current balance: 1.35 (DOLLAR, Q, D)
Input: DOLLAR
Current balance: 2.35 (DOLLAR, Q, D, DOLLAR)
Input: GET-C
C
Return coins: Q, Q, Q, D
Input: DOLLAR
Current balance: 1.00 (DOLLAR)
Input: GET-A
A
Return coins: Q, D
Input: DOLLAR
Current balance: 1.00 (DOLLAR)
Input: GET-A
Item not found. Please choose another item.
Input:
```
