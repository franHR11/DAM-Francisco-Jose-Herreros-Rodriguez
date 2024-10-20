#include <iostream>
#include <ctime> // For clock() function

int main() {
    // Start time
    double inicio = clock();
    std::cout << "Start time: " << inicio / CLOCKS_PER_SEC << " seconds" << std::endl;

    // Variables
    const long long iteraciones = 1000000000;
    double numero = 1.00000000065;

    // Loop
    for (long long i = 0; i < iteraciones; ++i) {
        numero *= 1.000000045;
    }

    // End time
    double final = clock();
    std::cout << "End time: " << final / CLOCKS_PER_SEC << " seconds" << std::endl;

    // Duration
    std::cout << "Elapsed time: " << (final - inicio) / CLOCKS_PER_SEC << " seconds" << std::endl;

    return 0;
}