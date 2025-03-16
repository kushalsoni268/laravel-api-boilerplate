#!/bin/bash

# Clear the screen
clear

# Install Figlet & Jq
if command -v figlet &> /dev/null
then
    echo ""
else
    sudo apt update
    sudo apt install figlet
fi

if command -v jq &> /dev/null
then
    echo ""
else
    sudo apt update
    sudo apt install jq
fi

# Define an array of JSON objects
json_array=(
  '{"name": "local","command": "cp config-env/local/.env.example .env"}'
  '{"name": "dev","command": "cp config-env/dev/.env.example .env"}'
  '{"name": "prod","command": "cp config-env/prod/.env.example .env"}'
)

# # Use jq to filter the array and print only the names
index=0
echo -e "\n"

figlet_output=$(figlet ":::::: Servers ::::::")
echo "$figlet_output"
for index in "${!json_array[@]}"; do
	name=$(echo "${json_array[index]}" | jq -r '.name')
	echo "$((index+1)). $name"
done

echo -e "\n"
# Read the number from the user input
# shellcheck disable=SC2162
read -p "Choose server number between 1 and ${#json_array[@]}: " number

# Check if the number is valid
if [[ ! $number =~ ^[0-9]+$ ]]; then
	echo "Invalid number. Please enter a positive integer. 🤣"
	exit 1
fi

# Check if the number is within the range of the array length
if (( number < 1 || number > ${#json_array[@]} )); then
	echo "Number out of range. Please enter a number between 1 and ${#json_array[@]}. 🤣"
	exit 2
fi

# # Get the value from the array using the number as the index
name=$(echo "${json_array[number-1]}" | jq -r '.name')
command=$(echo "${json_array[number-1]}" | jq -r '.command')

echo -e "\n"
# Run the value as a command to connect to the server
eval "$command"
eval "composer dump-autoload"
eval "php artisan optimize:clear"

echo "Environment Setup Successfully 🎆 🎉"

