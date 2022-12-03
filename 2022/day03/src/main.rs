use itertools::Itertools;
use std::collections::HashSet;
use std::fs::File;
use std::io::BufReader;
use std::io::prelude::*;

fn part_one(rucksacks: &Vec<String>) -> u32 {
    let mut priority_sum = 0;

    for rucksack in rucksacks {
        let (first, second) = rucksack.split_at(rucksack.len() / 2);

        let first_set: HashSet<char> = first.chars().collect();
        let second_set: HashSet<char> = second.chars().collect();

        let common_item = first_set.intersection(&second_set);

        for item in common_item {
            priority_sum += get_priority_value(item);
        }
    }

    priority_sum
}

fn part_two(rucksacks: &Vec<String>) -> u32 {
    let mut priority_sum = 0;

    for (a, b, c) in rucksacks.iter().tuples() {
        let a_set: HashSet<char> = a.chars().collect();
        let b_set: HashSet<char> = b.chars().collect();
        let c_set: HashSet<char> = c.chars().collect();

        let common_item: Vec<_> = a_set.iter()
            .filter(|k| b_set.contains(k))
            .filter(|k| c_set.contains(k))
            .collect();


        for item in common_item {
            priority_sum += get_priority_value(item);
        }
    }

    priority_sum
}

fn get_priority_value(ch: &char) -> u32 {
    let mut value = 0;

    if ch.is_uppercase() {
        value += 1 + 26 + (*ch as u32 - 'A' as u32);
    } else {
        value += 1 + (*ch as u32 - 'a' as u32);
    }

    value
}

fn main() -> std::io::Result<()> {
    let file = File::open("input.txt")?;
    let reader = BufReader::new(file);

    let rucksacks: Vec<String> = reader
        .lines()
        .map(|l| l.unwrap())
        .collect();

    println!("Part 1: {}", part_one(&rucksacks));
    println!("Part 2: {}", part_two(&rucksacks));

    Ok(())
}
