#include <iostream>

// Function to find indices
void findIndices(int numbers[], int size, int target) {
    int left = 0;
    int right = size - 1;

    while (left < right) {
        int current_sum = numbers[left] + numbers[right];

        if (current_sum == target) {
            std::cout << "Indices: (" << left << ", " << right << ") with values "
                      << numbers[left] << " and " << numbers[right]
                      << " add up to " << target << std::endl;
            return;
        } else if (current_sum < target) {
            left++;
        } else {
            right--;
        }
    }

    std::cout << "No such numbers exist in the list." << std::endl;
}

int main() {
    int size;
    int target_number;

    for (;;) {
        int choice;
        std::cout << "1. Find indices whose values add up to a target number\n";
        std::cout << "2. Exit\n";
        std::cout << "Enter your choice: ";
        std::cin >> choice;

        switch (choice) {
            case 1: {
                std::cout << "Enter the size of the array: ";
                std::cin >> size;

                int nums[size];
                std::cout << "Enter the elements of the array in non-decreasing order: ";
                for (int i = 0; i < size; ++i) {
                    std::cin >> nums[i];
                }

                std::cout << "Enter the target number: ";
                std::cin >> target_number;

                findIndices(nums, size, target_number);
                break;
            }
            case 2:
                std::cout << "Exiting the program.\n";
                return 0;
            default:
                std::cout << "Invalid choice. Please enter a valid option.\n";
        }
    }

    return 0;
}
