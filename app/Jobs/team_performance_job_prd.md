# Product Requirements Document (PRD) for Team Performance Job

## Introduction
The Team Performance Job is a background processing job designed to manage and optimize the performance of team-related activities within a multi-level marketing (MLM) system. This job automates the handling of team performance data, ensuring that the system efficiently processes user activations, income distributions, and referral hierarchies. The functionality is designed to be reusable across different plans within the MLM framework.

## Objectives
- To automate the processing of team performance data.
- To ensure accurate tracking and updating of user activation statuses.
- To facilitate income generation through various MLM plans.
- To provide a scalable solution that can be adapted for different team structures and plans.

## Functional Requirements
1. **Job Execution**: The job should be executed in the background and should be capable of handling multiple instances without conflicts.
2. **Data Fetching**: 
   - Retrieve the latest activation turn ID with a status of 'success' and 'pending'.
   - Fetch rows from the `team_performance_queue` based on the latest activation turn ID.
3. **Status Management**:
   - Update the activation status of the job to 'processing' when it begins processing a row.
   - Mark the row as 'success' or 'failed' based on the outcome of the processing.
4. **Income Generation**:
   - Generate referral income for users based on their performance and hierarchy.
   - Calculate and distribute ROI income and level income based on predefined rules.
5. **Error Handling**: Implement robust error handling to manage exceptions and log errors for troubleshooting.
6. **Scalability**: The job should be designed to handle an increasing number of users and performance data without degradation in performance.

## Non-Functional Requirements
1. **Performance**: The job should execute within a reasonable time frame to ensure timely updates to user statuses and income calculations.
2. **Reliability**: The job must be reliable, ensuring that all data is processed accurately and consistently.
3. **Maintainability**: The code should be modular and well-documented to facilitate future enhancements and maintenance.
4. **Security**: Ensure that all data handling complies with security best practices to protect user information.

## Conclusion
This PRD outlines the essential features and requirements for the Team Performance Job functionality. By adhering to these specifications, the job can be effectively reused across different plans, ensuring a consistent and efficient approach to managing team performance within the MLM system.