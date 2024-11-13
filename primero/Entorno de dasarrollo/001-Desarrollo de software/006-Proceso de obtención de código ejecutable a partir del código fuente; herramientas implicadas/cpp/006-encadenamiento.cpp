#include <iostream>															// Incluyo una librería de flujo (stream) de entrada (input) y salida (output)
	
int main(){																		// Creo una funcion, pero es el punto de entrada de la ejecucion, la funcion devuelve un entero
	int edad = 46;
	std::string nombre = "Francisco Jose";								// De la libreria std, importo el tipo de dato string, y creo una variable
	std::cout << "hola mundo desde C++ y me llamo" << nombre << "Y estoy muy contento de aprender C++";	// De la libreria estanda (std) quiero usar el comando C-out, y saco una cadena
	return 0;																	// Cumplo la promesa de devolver un entero
}